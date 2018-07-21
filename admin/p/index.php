<style type="text/css">
	.top{margin: 10px 5px;}
	.top .ranking{
		border: 1px solid;
		border-collapse: collapse;
	}
	.top .ranking th,.top .ranking td{border: 1px solid #666;padding: 3px 6px;}
</style>
<div class="top">
	<table class="ranking">
		<td colspan="2" style="text-align: center;">Top Ranking</td>
		<tr>
			<th>Usuario</th>
			<th>Vitimas</th>
		</tr>
		<?php
		$ler = ler_db("vitimas", "WHERE privacidade <> 'lixo' GROUP BY id_link ORDER BY qtd DESC LIMIT 3;", "dono, id_link, count(id_link) AS qtd");				
		if (!empty($ler)) {
			foreach ($ler as $lers) {
				?>
				<tr>
					<td><?php echo $lers['dono'] ;?></td>
					<td><?php echo $lers['qtd'] ;?></td>
				</tr>
				<?php
			}
		}else{
			echo "Vazio";
		}
		?>
	</table>
</div>
