<div id="deleteModal" class="modal mx-auto lg:pl-64">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Tem certeza que deseja eliminar?</p>
        <div class="modal-actions">
            <form id="deleteForm" method="post" action="">
                @csrf
                @method('DELETE')
                <button id="confirmDelete" class="confirm-button">Excluir</button>
            </form>
        </div>
    </div>
</div>

<script>
    //Abrir modal
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('deleteModal').style.display = 'block';
    });

    //Fechar modal
    document.querySelectorAll('.close, #cancelDelete').forEach(function(element) {
        element.addEventListener('click', function() {
            document.getElementById('deleteModal').style.display = 'none';
        });
    });

    //Enviar o formulário
    document.getElementById('confirmDelete').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
