<?php

namespace DeploymentTool\Controller;
class DeploymentController
{
    /**
     * Clean up method to remove files and directories recursively.
     * @param mixed $path
     * @return void
     */
    public static function cleanUp($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            } elseif (is_dir($file)) {
                self::cleanUp($file);
                rmdir($file);
            }
        }
    }
}

?>