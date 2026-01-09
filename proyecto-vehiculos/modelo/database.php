<?php
class Database
{
    public static function color_connection()
    {
        return new PDO('mysql:host=sql10.freesqldatabase.com;dbname=sql10813848;port=3306', 'sql10813848', 'GV6rP13v1L');
    }

    public static function marca_connection()
    {
        return new PDO('mysql:host=sql3.freesqldatabase.com;dbname=sql3813845;port=3306', 'sql3813845', 'uq8Zp4k5fqL');
    }

    public static function vehiculo_connection()
    {
        return new PDO('mysql:host=sql5.freesqldatabase.com;port=3306;dbname=sql5813849', 'sql5813849', 'SdxbcArbqW');
    }

    
}
