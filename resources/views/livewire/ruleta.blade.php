<div class="text-center">
    <button class="boton boton-color-verde-oscuro" id="spinBtn">Girar Ruleta</button>
</div>
<div class="container-fluid vh-100 d-flex flex-column justify-content-center align-items-center">
    <!-- Botón Girar 
    <button id="spinBtn" class="btn btn-success btn-lg">Girar Ruleta</button>
    -->

    <!-- Ruleta -->
    <div class="position-relative mb-3" style="max-width:500px; width:90%;">
        <canvas id="wheelCanvas" class="shadow rounded-circle w-100"></canvas>
        <!-- Flecha arriba -->
        <div class="position-absolute top-0 start-50 translate-middle-x"
            style="margin-top:-20px; width:0; height:0; border-left:10px solid transparent; border-right:10px solid transparent; border-bottom:16px solid #02555b;">
        </div>
    </div>

    <!-- Texto de categoría seleccionada -->
    <div id="selectedCategoryText" class="mb-3 text-center fs-5 fw-semibold"></div>


</div>

<script>
    const canvas = document.getElementById('wheelCanvas');
    const ctx = canvas.getContext('2d');
    const categories = @js($categories);

    let rotation = 0;
    let centerX, centerY, radius;

    // Ajustar tamaño del canvas según el contenedor
    function resizeCanvas() {
        const parentWidth = canvas.parentElement.offsetWidth;
        canvas.width = parentWidth;
        canvas.height = parentWidth;
        centerX = canvas.width / 2;
        centerY = canvas.height / 2;
        radius = canvas.width / 2 - 10;
        drawWheel();
    }

    window.addEventListener('resize', resizeCanvas);

    function drawWheel() {
        const sliceAngle = 2 * Math.PI / categories.length;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        categories.forEach((cat, i) => {
            ctx.fillStyle = `hsl(${i * (360/categories.length)}, 70%, 50%)`;
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, i * sliceAngle, (i + 1) * sliceAngle);
            ctx.closePath();
            ctx.fill();

            // Texto proporcional
            ctx.save();
            ctx.translate(centerX, centerY);
            ctx.rotate(i * sliceAngle + sliceAngle / 2);
            ctx.textAlign = "right";
            ctx.fillStyle = "white";
            ctx.font = `15px sans-serif`;
            ctx.fillText(cat.name, radius - 20, 0);
            ctx.restore();
        });
    }

    function spinWheel() {
        const spinDeg = Math.random() * 360 + 720;
        const duration = 4000;
        const start = performance.now();

        function animate(time) {
            const elapsed = time - start;
            const progress = Math.min(elapsed / duration, 1);
            const easeOut = 1 - Math.pow(1 - progress, 3);
            rotation = easeOut * spinDeg;
            ctx.setTransform(1, 0, 0, 1, 0, 0);
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.translate(centerX, centerY);
            ctx.rotate(rotation * Math.PI / 180);
            ctx.translate(-centerX, -centerY);
            drawWheel();

            if (progress < 1) requestAnimationFrame(animate);
            else {
                const selectedIndex = Math.floor(((360 - (rotation % 360)) / 360) * categories.length);
                const selectedCategory = categories[selectedIndex];
                document.getElementById('selectedCategoryText').innerText = "Categoría seleccionada: " +
                    selectedCategory.name;

                setTimeout(() => {
                    @this.selectedCategory = selectedCategory;
                    @this.spinWheel();
                }, 1500);
            }
        }
        requestAnimationFrame(animate);
    }

    // Inicializar
    resizeCanvas();
    document.getElementById('spinBtn').addEventListener('click', spinWheel);
</script>
