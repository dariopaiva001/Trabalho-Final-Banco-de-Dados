<?php
session_start();
include 'conexao.php';
include 'menu_admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<div class="container h-100">
			<div class="row justify-content-sm-center h-100">

				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
            
					</div>
					<div class="card shadow-lg">
          <!-- Título -->
          <div class="text-center my-1">
            <h3>Total de candidatos</h3>
          </div>
			
		    <?php 
			//consulta 7
		    $sqlTOTAL = "SELECT COUNT(id) AS total FROM form";
			$resultTOTAL = mysqli_query($conexao, $sqlTOTAL);
			$rowTOTAL = mysqli_fetch_assoc($resultTOTAL);
			?>
			<div class="card-body p-5 text-center">
    		<h1><?php echo $rowTOTAL['total']; ?></h1>
			</div>


					<div class="card-body p-5">
							 	


				</div>
			</div>
		</div>

    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
					</div>
					<div class="card shadow-lg">

          <!-- Título -->
			<?php 
			$cursos = [
  			1 => "Enfermagem",
  			2 => "Informática",
  			3 => "Desenvolvimento de Sistemas",
  			4 => "Administração"
			];
			?>


          <div class="text-center my-1">
            <h3>Candidatos por curso</h3>
            <?php 
			//consulta 8
		    $sqlpCurso = "SELECT curso, COUNT(id) AS totalpCurso FROM form GROUP BY curso";
			$resultpCurso = mysqli_query($conexao, $sqlpCurso);
			?>
			<div class="card-body p-5">
			<?php while ($rowpCurso = mysqli_fetch_assoc($resultpCurso)) : 
        	$nomeCurso = $cursos[$rowpCurso['curso']]; 
    		?>
        	<p><strong><?php echo $nomeCurso; ?>:</strong> <?php echo $rowpCurso['totalpCurso']; ?></p>
    		<?php endwhile; ?>
			</div>
            

          </div>

						<div class="card-body p-5">
							
				</div>
			</div>
		</div>
    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
					</div>
					<div class="card shadow-lg">

          <!--titulo-->
          <div class="text-center my-1">
            <h3>Curso com mais candidatos</h3>
          </div>


				<?php
				// Mapeamento de IDs para nomes
				$cursos = [
				  1 => "Enfermagem",
				  2 => "Informática",
				  3 => "Desenvolvimento de Sistemas",
				  4 => "Administração"
				];
				
				// Consulta para descobrir qual curso tem mais candidatos
				$sqlMax = "
				    SELECT curso, COUNT(id) AS total
				    FROM form
				    GROUP BY curso
				    ORDER BY total DESC
				    LIMIT 1
				";
				
				$resultMax = mysqli_query($conexao, $sqlMax);
				$rowMax = mysqli_fetch_assoc($resultMax);
				
				// pega o nome do curso pelo ID
				$cursoNome = $cursos[$rowMax['curso']];
				$quantidade = $rowMax['total'];
				?>
				
				<div class="card-body p-5 text-center">
				    <h4>Curso com mais candidatos:</h4>
				    <h2><strong><?php echo $cursoNome; ?></strong></h2>
				    <p>Total de candidatos: <?php echo $quantidade; ?></p>
				</div>


						<div class="card-body p-5">
							
				</div>
			</div>
		</div>
</div>
</div>
</body>
</html>