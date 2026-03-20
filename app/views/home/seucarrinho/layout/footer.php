   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <script>
       // Inicializar Tooltips (Para o efeito de hover no Usuário)
       var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
       var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
           return new bootstrap.Tooltip(tooltipTriggerEl)
       })

       // Função para abrir/fechar itens da lista
       function toggleItems(id) {
           const el = document.getElementById(id);
           if (el.style.display === "block") {
               el.style.display = "none";
           } else {
               el.style.display = "block";
           }
       }
   </script>
   </body>

   </html>