<?php
	
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'http://mpp.palembang.go.id/getdatatoken' );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	$result = curl_exec($ch );
	curl_close( $ch );

?>