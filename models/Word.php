<?php

class Word
{
	private $id;
	private $bgword;
	private $enword;
	private $imagepath;
	private $complexity_id;
	private $unit_id;

	function __construct()
	{
		
	}

	public function getId() {
		return $this->id;
	}

	public function getBgWord() {
		return $this->bgword;
	}

	public  function getEnWord() {
		return $this->enword;
	}
	
	public  function getImagePath() {
		return $this->imagepath;
	}
	
	public  function getComplexityId() {
		return $this->complexity_id;
	}

	public  function getUnitId() {
		return $this->unit_id;
	}

	public function setId($id) {
		$this->id = $id;
	}
	
	public function setBgWord($bg_word) {
		$this->bgword = $bg_word;
	}

	public function setEnWord($en_word) {
		$this->enword = $en_word;
	}

	public  function setImagePath($path) {
		$this->imagepath = $path;
	}
	
	public  function setComplexityId($complexity_id) {
		$this->complexity_id = $complexity_id;
	}
	
	public  function setUnitId($unit_id) {
		$this->unit_id = $unit_id;
	}
}