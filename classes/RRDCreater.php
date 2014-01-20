<?php
/*
 * @project: php_rrd for Microsoft Windows IIS
 * @developer: x86dev <x86dev@gmx.com>
 *
*/

if ( !class_exists ( 'RRDCreator' ) )
{
    class RRDCreator
    {
        private $sFilename        = '';
        private $sCommandLine     = '';
        private $sCommandLineArgs = '';


        public function __construct ( $sFilename, $iTime = false, $iStep = 0 )
        {
            if ( $iTime == false ) $iTime = time ( );

            $this->sFilename        = $sFilename;
            $this->sCommandLine     = getcwd ( ) . '\ext\rrdtool\rrdtool.exe';
            $this->sCommandLineArgs = 'create ' . $sFilename . ' --start ' . $iTime . ' --step ' . $iStep;
        }


        public function addDataSource ( $sString )
        {
            $this->sCommandLineArgs .= ' DS:' . $sString;
        }


        public function addArchive ( $sString )
        {
            $this->sCommandLineArgs .= ' RRA:' . $sString;
        }


        public function output ( )
        {
            return $this->sCommandLine . ' ' . $this->sCommandLineArgs;
        }


        public function save ( )
        {
            $sOutput = shell_exec ( $this->sCommandLine . ' ' . $this->sCommandLineArgs );

            return file_exists ( $this->sFilename );
        }
    }
}
?>