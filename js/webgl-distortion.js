class MouseDistortionEffect {
  constructor(imagePath = null) {
    // Prevent multiple instances
    if (window.mouseDistortionActive) {
      console.log("MouseDistortionEffect already active, skipping...");
      return;
    }
    window.mouseDistortionActive = true;

    console.log("🚀 Initializing MouseDistortionEffect");

    const canvas = document.getElementById("webgl-canvas");
    if (!canvas) {
      console.error("❌ Canvas element not found!");
      return;
    }

    this.scene = new THREE.Scene();
    this.camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0, 1);
    this.renderer = new THREE.WebGLRenderer({
      canvas: canvas,
      alpha: true,
      antialias: true,
    });

    this.mouse = new THREE.Vector2();
    this.targetMouse = new THREE.Vector2();

    // Fixed uniforms object - added resolution and imageAspect
    this.uniforms = {
      uTexture: { type: "t", value: null },
      uMouse: { type: "v2", value: new THREE.Vector2() },
      uTime: { type: "f", value: 0 },
      uDistortion: { type: "f", value: 1.2 },
      uRadius: { type: "f", value: 0.3 },
      uResolution: {
        type: "v2",
        value: new THREE.Vector2(window.innerWidth, window.innerHeight),
      },
      uImageAspect: { type: "f", value: 1.0 },
    };

    this.imagePath = imagePath;
    this.material = null;

    this.init();
    this.loadTexture();
  }

  init() {
    this.renderer.setSize(window.innerWidth, window.innerHeight);
    this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    this.renderer.setClearColor(0x000000, 0);
    console.log("✅ Renderer initialized");
  }

  loadTexture() {
    if (this.imagePath) {
      console.log("🔄 Loading image:", this.imagePath);
      const loader = new THREE.TextureLoader();
      loader.load(
        this.imagePath,
        (texture) => {
          console.log("✅ Image loaded successfully");
          texture.minFilter = THREE.LinearFilter;
          texture.magFilter = THREE.LinearFilter;

          // Calculate and store image aspect ratio
          const img = texture.image;
          const imageAspect = img.width / img.height;
          this.uniforms.uImageAspect.value = imageAspect;

          this.uniforms.uTexture.value = texture;
          this.createMaterial();
        },
        undefined,
        (error) => {
          console.error("❌ Error loading image:", error);
          this.createFallbackTexture();
        }
      );
    } else {
      this.createFallbackTexture();
    }
  }

  createFallbackTexture() {
    console.log("🎨 Creating fallback texture");
    const canvas = document.createElement("canvas");
    canvas.width = 1920;
    canvas.height = 1080;
    const ctx = canvas.getContext("2d");

    const gradient = ctx.createLinearGradient(
      0,
      0,
      canvas.width,
      canvas.height
    );
    gradient.addColorStop(0, "#667eea");
    gradient.addColorStop(0.5, "#764ba2");
    gradient.addColorStop(1, "#f093fb");

    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    const texture = new THREE.CanvasTexture(canvas);
    texture.minFilter = THREE.LinearFilter;
    texture.magFilter = THREE.LinearFilter;

    // Set fallback image aspect ratio
    this.uniforms.uImageAspect.value = canvas.width / canvas.height;
    this.uniforms.uTexture.value = texture;
    this.createMaterial();
  }

  createMaterial() {
    console.log("🎭 Creating material");

    const vertexShader = `
            varying vec2 vUv;

            void main() {
                vUv = uv;
                gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
            }
        `;

    const fragmentShader = `
            uniform sampler2D uTexture;
            uniform vec2 uMouse;
            uniform float uTime;
            uniform float uDistortion;
            uniform float uRadius;
            uniform vec2 uResolution;
            uniform float uImageAspect;

            varying vec2 vUv;

            vec2 getObjectFitCoverUv(vec2 uv, float imageAspect, vec2 resolution) {
                float screenAspect = resolution.x / resolution.y;

                vec2 newUv = uv;

                if (imageAspect > screenAspect) {
                    // Image is wider than screen - fit height, crop sides
                    float scale = screenAspect / imageAspect;
                    newUv.x = (uv.x - 0.5) * scale + 0.5;
                } else {
                    // Image is taller than screen - fit width, crop top/bottom
                    float scale = imageAspect / screenAspect;
                    newUv.y = (uv.y - 0.5) * scale + 0.5;
                }

                return newUv;
            }

            void main() {
                vec2 uv = vUv;

                // Apply object-fit: cover transformation
                vec2 coverUv = getObjectFitCoverUv(uv, uImageAspect, uResolution);

                // Calculate distance from mouse
                float distance = length(uv - uMouse);

                // Create smooth distortion falloff
                float distortionStrength = smoothstep(uRadius, 0.0, distance) * uDistortion;

                // Calculate direction from current pixel to mouse
                vec2 direction = normalize(uv - uMouse);

                // Add wave animation
                float wave = sin(distance * 15.0 - uTime * 2.0) * 0.6 + 0.6;
                distortionStrength *= wave * 0.8;

                // Apply distortion to the cover UV coordinates
                vec2 distortedUv = coverUv + direction * distortionStrength * 0.08;

                // Sample texture with chromatic aberration
                float r = texture2D(uTexture, distortedUv + direction * distortionStrength * 0.005).r;
                float g = texture2D(uTexture, distortedUv).g;
                float b = texture2D(uTexture, distortedUv - direction * distortionStrength * 0.005).b;

                gl_FragColor = vec4(r, g, b, 1.0);
            }
        `;

    try {
      this.material = new THREE.ShaderMaterial({
        uniforms: this.uniforms,
        vertexShader: vertexShader,
        fragmentShader: fragmentShader,
        transparent: true,
      });

      const geometry = new THREE.PlaneGeometry(2, 2);
      const mesh = new THREE.Mesh(geometry, this.material);
      this.scene.add(mesh);

      console.log("✅ Material created successfully");

      // Start animation and events
      this.addEventListeners();
      this.animate();
    } catch (error) {
      console.error("❌ Error creating material:", error);
    }
  }

  addEventListeners() {
    console.log("👂 Adding event listeners");

    this.onMouseMove = (event) => {
      // Convert to UV coordinates (0 to 1) instead of NDC (-1 to 1)
      this.targetMouse.x = event.clientX / window.innerWidth;
      this.targetMouse.y = 1.0 - event.clientY / window.innerHeight; // Flip Y axis
    };

    this.onResize = () => {
      this.renderer.setSize(window.innerWidth, window.innerHeight);
      this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      // Update resolution uniform for proper aspect ratio calculation
      this.uniforms.uResolution.value.set(
        window.innerWidth,
        window.innerHeight
      );
    };

    this.onTouchMove = (event) => {
      event.preventDefault();
      const touch = event.touches[0];
      // Convert to UV coordinates (0 to 1) instead of NDC (-1 to 1)
      this.targetMouse.x = touch.clientX / window.innerWidth;
      this.targetMouse.y = 1.0 - touch.clientY / window.innerHeight; // Flip Y axis
    };

    window.addEventListener("mousemove", this.onMouseMove);
    window.addEventListener("resize", this.onResize);
    window.addEventListener("touchmove", this.onTouchMove, { passive: false });
  }

  animate() {
    if (!this.material) return;

    this.animationId = requestAnimationFrame(() => this.animate());

    // Smooth mouse following
    this.mouse.lerp(this.targetMouse, 0.1);

    // Update uniforms
    if (this.material.uniforms.uMouse) {
      this.material.uniforms.uMouse.value.copy(this.mouse);
    }
    if (this.material.uniforms.uTime) {
      this.material.uniforms.uTime.value += 0.016; // ~60fps
    }

    this.renderer.render(this.scene, this.camera);
  }

  destroy() {
    // Cleanup method
    if (this.animationId) {
      cancelAnimationFrame(this.animationId);
    }

    window.removeEventListener("mousemove", this.onMouseMove);
    window.removeEventListener("resize", this.onResize);

    // Only remove touch events if they were added
    if (this.onTouchMove) {
      window.removeEventListener("touchmove", this.onTouchMove);
    }

    window.mouseDistortionActive = false;
  }
}

// Single initialization
let effectInstance = null;

function initMouseDistortion() {
  // Don't initialize on mobile devices
  if (window.innerWidth <= 1080) {
    console.log("Mobile device detected, skipping mouse distortion effect");
    return;
  }

  if (effectInstance) {
    console.log("Effect already exists, skipping...");
    return;
  }

  console.log("🎬 Initializing mouse distortion effect");
  effectInstance = new MouseDistortionEffect("./images/hero/hero.webp");
}

// Wait for DOM to be ready
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initMouseDistortion);
} else {
  initMouseDistortion();
}
