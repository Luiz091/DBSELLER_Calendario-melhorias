<?php
  use DAO\Area;
?>

<div class="container" id="agenda">
  <form class="col-sm-12 col-md-6" method="POST">
    <div class="form-row">
      <div class="form-group col-sm-12">
        <div class="form-group">
          <label for="exampleFormControlInput1">Cadastrar Área</label>
          <input type="text" class="form-control" name="area" value="<?= inputs('area') ?>" id="area" placeholder="Informe a Área">
        </div>
      </div>
    </div>
    <button type="submit" name="btn-cad" id="btn_buscar" class="btn btn-success">Cadastrar nova área</button>
    <a type="button" class="btn btn-secondary" id="in_taref" href="index.php"> Voltar para o Início</a>
  </form>
  <div style="margin-top:100px;"></div>

  <?php
    if (isset($_POST['area']) && !empty($_POST['area'])) {
      $area = trim(strip_tags($_POST['area']));
      $areaEx = Area::getInstance()->areaExist(ucfirst($area));
      if (!$areaEx) {
        Area::getInstance()->insert($_POST['area']);
        header('Location:?p=areas');
      } else {
        echo '<div id="msg" style="margin-left:500px;color:red"><b>Operação Não permitida! Área Informada já cadastrada...</div>';
      }
    } else {
      if (isset($_POST['btn-cad'])) {
        echo '<div id="msg" style="margin-left:500px;color:red"><b>O Campo Área deve ser preenchido.</div>';
      }
    }

    if (isset($_GET['del']) && !empty($_GET['del']) && !is_null($_GET['del'])) {
      $areaTarefa = Area::getInstance()->areaTarefaExiste($_GET['del']);
      if (!$areaTarefa) {
        Area::getInstance()->areaDelete($_GET['del']);
        header('Location:?p=areas');
      } else {
        echo '<div id="msg2" style="margin-left:500px;color:red"><b>Operação Inválida, área vinculada a uma tarefa...</div>';
      }
    }

    function inputs($value)
    {
      if (isset($_POST[$value])) {
        echo $_POST[$value];
      } else {
        echo '';
      }
    }
  ?>

  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">CÓDIGO</th>
        <th scope="col">ÁREA</th>
        <th scope="col">AÇÕES</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if (!empty($_GET['p'])) {
        $areasDB = Area::getInstance()->getAll();
      }
      foreach ($areasDB as $area) :?>
        <tr>
          <th scope="row"><?= $area->id ?></th>
          <td class="aling-itens"><?= $area->descricao ?></td>
          <td>
            <a type="button" class="btn btn-warning" href="views/edit_areas.php?id=<?= $area->id ?>&desc=<?= $area->descricao ?>">Editar</a>
            <a type="button" class="btn btn-danger" href="?p=areas&del=<?= $area->id ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>