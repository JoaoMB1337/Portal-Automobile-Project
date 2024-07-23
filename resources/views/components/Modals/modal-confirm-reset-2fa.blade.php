<div id="reset2faModal" class="modal mx-auto lg:pl-64">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Deseja resetar a autenticação de dois fatores para este funcionário?</p>
        <div class="modal-actions">
            <form id="reset2faForm" method="post" action="">
                @csrf
                @method('PUT')
                <button id="confirmReset2FA" class="confirm-button">Confirmar</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Abrir modal
    document.getElementById('openReset2FAModalBtn').addEventListener('click', function() {
        document.getElementById('reset2faModal').style.display = 'block';
        document.getElementById('reset2faForm').action = this.dataset.action;
    });

    // Fechar modal
    document.querySelectorAll('.close, #cancelReset2FA').forEach(function(element) {
        element.addEventListener('click', function() {
            document.getElementById('reset2faModal').style.display = 'none';
        });
    });

    // Enviar o formulário
    document.getElementById('confirmReset2FA').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('reset2faForm').submit();
    });
</script>
