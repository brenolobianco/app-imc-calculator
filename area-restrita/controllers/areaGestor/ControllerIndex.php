<?php

include_once '../../models/conexao.php';
// VARIAVEL COM OS TEXTOS DE PERMISSAO DE ACESSO AS FUNCIONALIDADES
$PERMISSOES = array(0 => 'Não permitido', 1 => 'Permitido');

$select = "SELECT * from login";
try {
	$result = $conexao->prepare($select);
	$result->execute();
	$contar = $result->rowCount();

	if($contar>0) {
		while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {//var_dump($mostra);			
?>
<tr>
	<td><?= $mostra->id?></td>
	<td><?= $mostra->nome;?></td>
	<td><?= $mostra->usuario;?></td>
	<td><?php 
	// PERMISSOES
	$res_permissao = $conexao->prepare("SELECT * FROM permissao_setor WHERE id_login = :id");
	$res_permissao->bindParam(':id',$mostra->id, PDO::PARAM_INT);
	$res_permissao->execute();
	
	if($res_permissao->rowCount() > 0){
		while ($perm = $res_permissao->FETCH(PDO::FETCH_OBJ)) {
			echo '<b>Dashboard</b>: '.$PERMISSOES[$perm->dashboard].'<br />';
			echo '<b>Conteúdo</b>: '.$PERMISSOES[$perm->conteudo].'<br />';
			echo '<b>Ranking</b>: '.$PERMISSOES[$perm->ranking].'<br />';
			echo '<b>Acadêmico</b>: '.$PERMISSOES[$perm->academico].'<br />';
			echo '<b>Médico</b>: '.$PERMISSOES[$perm->medico].'<br />';			
			echo '<b>Professor</b>: '.$PERMISSOES[$perm->professor].'<br />';
			echo '<b>Hospital</b>: '.$PERMISSOES[$perm->hospital].'<br />';
			echo '<b>Curso</b>: '.$PERMISSOES[$perm->curso].'<br />';
			echo '<b>Aula</b>: '.$PERMISSOES[$perm->aula];
		}
	}
	?></td>
	<td><a href="home.php?acao=usuario&op=add&id=<?= $mostra->id;?>"
		class="btn btn-icon waves-effect waves-light btn-primary"> <i
			class="fa fa-eye"></i>
	</a> <a
		href="atualizar_usuario.php?<?= $mostra->id;?>"
		class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i
			class="fa fa-edit"></i>
	</a> <a href="home.php?acao=usuario&delete=<?= $mostra->id;?>"
		onClick="return confirm('Deseja realmente excluir?')"
		class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i
			class="fas fa-times"></i>&nbsp;
	</a></td>

	

</tr>
<?php
		}
	} else {
		echo '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="warning"></button>
        <strong> Nada Cadastrado!!!</strong> 
        </div>';
	}
} catch (PDOException $e) {
	echo $e;
}
?> 