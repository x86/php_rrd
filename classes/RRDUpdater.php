<?php
/*
 * @project: php_rrd for Microsoft Windows IIS
 * @developer: x86dev <x86dev@gmx.com>
 *
*/

if ( !class_exists ( 'RRDUpdater' ) )
{
    class RRDUpdater
    {
        private $sFilename        = '';
        private $sCommandLine     = '';
        private $sCommandLineArgs = '';


        public function __construct ( $sFilename )
        {
            $this->sFilename        = $sFilename;
            $this->sCommandLine     = getcwd ( ) . '\ext\rrdtool\rrdtool.exe';
            $this->sCommandLineArgs = 'update ' . $sFilename;
        }


        public function update ( $aData, $iTime = false )
        {
            // Check if valid
            if ( !is_array ( $aData ) )
            {
                return false;
            }

            if ( $iTime == false ) $iTime = time ( );

            // 
            $this->sCommandLineArgs .= ' -t ' . implode ( ':', array_keys ( $aData ) ) . ' ' . $iTime . ':' . implode ( ':', array_values ( $aData ) );

            // Execute
            $sOutput = shell_exec ( $this->sCommandLine . ' ' . $this->sCommandLineArgs );
        }


        public function output ( )
        {
            return $this->sCommandLine . ' ' . $this->sCommandLineArgs;
        }
	}
}
?>