<?php
/**
 * 
 * @author Freddy Alexander Vivas Reyes
 * @copyright 2012
 *
 */
class Bitacora {
	private $consecutivo;
	private $id_parte;
	private $fechahora;
	private $motivo;
	private $asunto;
	private $heridos;
	private $reporto;
	private $danos;
	private $ubicacion;
	private $emisor;
	private $importancia;
	private $anotacion;
	private $usuario;	
	
	function __construct($row) {
		$this->consecutivo = $row["consecutivo"];
		$this->id_parte = $row["id_parte"];
		$this->fechahora = $row["fechahora"];
		$this->motivo = $row["motivo"];
		$this->asunto = $row["asunto"];
		$this->heridos = $row["heridos"];
		$this->reporto = $row["reporto"];
		$this->danos = $row["danos"];
		$this->ubicacion = $row["ubicacion"];
		$this->emisor = $row["emisor"];
		$this->importancia = $row["importancia"];
		$this->anotacion = $row["anotacion"];
		$this->usuario = $row["usuario"];
	}
	
	function getConsecutivo() {
		return $this->consecutivo;
	}
	
	function getIdParte() {
		return $this->id_parte;
	}
	
	function getFechaHora() {
		return $this->fechahora;
	}
	
	function getMotivo() {
		return $this->motivo;
	}
	
	function getAsunto() {
		return $this->asunto;
	}
	
	function getHeridos() {
		return $this->heridos;
	}
	
	function getReporto() {
		return $this->reporto;
	}
	
	function getDanos() {
		return $this->danos;
	}
	
	function getUbicacion() {
		return $this->ubicacion;
	}
	
	function getEmisor() {
		return $this->emisor;
	}
	
	function getImportancia() {
		return $this->importancia;
	}
	
	function getAnotacion() {
		return $this->anotacion;
	}
	
	function getUsuario() {
		return $this->usuario;
	}
}