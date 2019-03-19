<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#settingsModal">
  Configuraciones
</button>

<!-- Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModal" aria-hidden="true">
<div class="modal-dialog" role="document">

  <!-- Content -->
  <div class="modal-content">

    <!-- Header -->
    <div class="modal-header">
      <h5 class="modal-title" id="titleLabel">Configuraciones</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Body -->
    <div class="modal-body">
      <label for="styles"></label>
      <select name="styles" id="styles" class="custom-select"></select>
      <br />
      <br />

      <form action="index.php" method="POST"><input type="submit" name="undo" id="undo" class="btn btn-primary btn-lg btn-block" value="Deshacer Movimiento"></input></form>
      <button type="button" id="resetGame" class="btn btn-danger btn-lg btn-block">Reiniciar Partida</button>
    </div>
    
  </div>
</div>
</div>