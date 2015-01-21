<?php

	class HTMLBuilder
	{

		public function __construct( $headerFile, $bodyFile, $footerFile )
		{
			$this->buildHeader( $headerFile );
			$this->buildBody( $bodyFile );
			$this->buildFooter( $footerFile );
		}

		public function buildHeader( $file )
		{
			$cssFiles	=	$this->findFiles( 'css', '.css' );

			$cssHtmlLinks	=	$this->buildCssLinks( $cssFiles );

			include_once( 'html/' . $file . '.partial.html' );
		}

		private function buildCssLinks( $files )
		{
			$container	=	'';

			foreach( $files as $file )
			{
				$container .= '<link rel="stylesheet" href="' . $file . '">';
			}

			return $container;
		}

		public function buildBody( $file )
		{
			include_once( 'html/' . $file . '.partial.html' );
		}

		public function buildFooter( $file )
		{

			$jsFiles	=	$this->findFiles( 'js', '.js' );

			$jsHtmlLinks	=	$this->buildjsLinks( $jsFiles );

			include_once( 'html/' . $file . '.partial.html' );
		}


		private function buildJsLinks( $files )
		{
			$container	=	'';

			foreach( $files as $file )
			{
				$container .= '<script src="' . $file . '"></script>';
			}

			return $container;
		}


		private function findFiles( $folder, $extension )
		{
			$searchString	=	$folder . "/*" . $extension;

			$fileArray = glob( $searchString );

			return $fileArray;
		}

	}

?>