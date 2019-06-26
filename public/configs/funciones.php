<?php
	function clear($var){
		htmlspecialchars($var);

		return $var;
	}

	function redir($var){
		?>
			<script>
				window.location="<?=$var?>";
			</script>
		<?php
		die();
	}

	function alert($var){
		?>
			<script type="text/javascript">
				alert("<?=$var?>");
			</script>
		<?php
		}
	
	function dtime($date){
		$e = explode("-", $date);

		$year = $e[0];
		$month = $e[1];
		$e2 = explode(" ",$e[2]);
		$day = $e2[0];
		$time = $e2[1];
		$e3 = explode(":",$time);
		$hour = $e3[0];
		$mins = $e3[1];
		$secs = $e3[2];
		return $day."/".$month."/".$year." ".$hour.":".$mins.":".$secs;
	}

	function status($idStatus){
		if($idStatus == 0){
			$status = "Starting";
		}elseif($idStatus == 1){
			$status = "Preparing";
		}elseif($idStatus == 2){
			$status = "Sending";
		}elseif($idStatus == 3){
			$status = "Delivered";
		}else{
			$status = "Undefined";
		}

		return $status;
	}
?>