<?php
				require_once "uploadConfig.php";
				$sql_query="SELECT id_pacjenta, imie, nazwisko, pesel FROM pacjenci";
				mysqli_report(MYSQLI_REPORT_STRICT);
				try
				{
					$connection = new mysqli($host,$db_user,$db_password,$db_name);
					if($connection->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						if ($sql_answer = @$connection->query($sql_query))
						{
							echo '<select name="pacjent">';
							while ($row = $sql_answer-> fetch_assoc())
							{
								echo "<option value=".$row['id_pacjenta'].">".$row['imie']." ".$row['nazwisko']."; pesel:".$row['pesel']."</option>";
							}
							echo '</select>';
							$connection->close();
						}
						else
						{
							throw new Exception($connection->error);
						}
					}
				} 
				catch (Exception $e) 
				{
					echo '<div class="error">"Błąd serwera"</div>';
					echo $e."<br/>";
				}
			?>