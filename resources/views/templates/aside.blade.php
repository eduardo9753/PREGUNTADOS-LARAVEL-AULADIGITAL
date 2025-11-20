 <aside class="sidebar">
     <div class="sidebar-header">
         <img src="https://enam.pe/img/brand/enam/logo_banquea.png" alt="Logo" class="logo">
         <h2>Preguntados</h2>
     </div>
     <div class="sidebar-menu">

         <a href="{{ route('game.home') }}" class="menu-item">
             <i class='bx bx-home'></i>
             <span>Home</span>
         </a>

         <a href="{{ route('game.rank.rule') }}" class="menu-item">
             <i class='bx bx-cog'></i>
             <span>Reglas del Juego</span>
         </a>

         <a href="{{ route('game.ruleta') }}" class="menu-item">
             <i class='bx bxs-game icon'></i> <!-- Jugar Solo / joystick -->
             <span>Jugar Solo</span>
         </a>

         <a href="{{ route('game.manager', ['user_id' => session('usuario.id')]) }}" class="menu-item">
             <i class='bx bxs-group icon'></i> <!-- Multijugador / grupo de personas -->
             <span>Multijugador</span>
         </a>

         <a href="{{ route('game.rank.ranking') }}" class="menu-item">
             <i class='bx bxs-trophy icon'></i> <!-- Rankings / trofeo -->
             <span>Rankings</span>
         </a>
         <a href="{{ route('logout') }}" class="menu-item">
             <i class='bx bxs-log-out-circle icon'></i> <!-- Salir / logout -->
             <span>Salir</span>
         </a>
     </div>
 </aside>
 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const toggle = document.createElement("button");
         toggle.classList.add("menu-toggle");
         toggle.innerHTML = "<i class='bx bx-menu'></i>";
         document.body.appendChild(toggle);

         const sidebar = document.querySelector(".sidebar");
         const overlay = document.createElement("div");
         overlay.classList.add("overlay");
         document.body.appendChild(overlay);

         toggle.addEventListener("click", () => {
             sidebar.classList.toggle("active");
             overlay.classList.toggle("active");
         });

         overlay.addEventListener("click", () => {
             sidebar.classList.remove("active");
             overlay.classList.remove("active");
         });
     });
 </script>
