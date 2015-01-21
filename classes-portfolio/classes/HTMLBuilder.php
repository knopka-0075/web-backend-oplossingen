<?php

	class HTMLbuilder {

		protected $header;
		protected $body;
		protected $footer;
	
		public function __construct($header, $body, $footer)
		{
			$this->header	=	$header;
			$this->body		=	$body;
			$this->footer	=	$footer;
			
			// Creëer pagina automatisch
			$this->buildPage();
		}
		
		public function buildHeader()
		{
			// Get css files
			$cssDir	=	 dirname(dirname(__FILE__)) . '/css/';
			$filesArray	=	$this->findFiles($cssDir, 'css');
			
			$cssLinks	=	$this->createCssLink($filesArray);
		
			include 'html/'. $this->header;
		}	
		
		public function buildBody()
		{
			include 'html/'. $this->body;
		}	
		
		public function buildFooter()
		{
			// Get JS-files
			$jsDir	=	 dirname(dirname(__FILE__)) . '/js/';
			$filesArray	=	$this->findFiles($jsDir, 'js');
			
			$jsScripts	=	$this->createJsScripts($filesArray);
			
			include 'html/'. $this->footer;
		}
		
		public function buildPage()
		{
			$this->buildHeader();
			$this->buildBody();
			$this->buildFooter();
		}
		
		public function findFiles($dir, $file)
		{
			
			return glob($dir . '/*.' . $file);	
		}
		
		public function createCssLink($filesArray)
		{
			$dumpArray	=	array();
			
			foreach ($filesArray as $file)
			{
				$fileInfo	=	pathinfo($file);
				$fileName	=	$fileInfo['basename'];
				
				$dumpArray[] = '<link rel="stylesheet" type="text/css" href="css/' . $fileName . '">';
			}
			
			return implode('', $dumpArray);
		}
		
		public function createJsScripts($filesArray)
		{
			$dumpArray	=	array();
			
			foreach ($filesArray as $file)
			{
				$fileInfo	=	pathinfo($file);
				$fileName	=	$fileInfo['basename'];
				
				$dumpArray[] = '<script src="js/' . $fileName . '"></script>';
			}
			
			return implode('', $dumpArray);
		}
	}


?>