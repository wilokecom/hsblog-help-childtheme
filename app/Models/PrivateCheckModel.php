<?php
/**
 * Class PrivateCheckModel
 */
class PrivateCheckModel
{
    /**
     * @return int
     * @param string $sMetaValue
     * @param        $sMetakey
     */
    public static function getTopicTotal($sMetakey, $sMetaValue = 'yes')
    {
        global $wpdb;
        $sQuery = "SELECT * FROM wp_postmeta WHERE (meta_key = %s AND meta_value = %s)";
        $aQuery = $wpdb->get_results($wpdb->prepare($sQuery, $sMetakey, $sMetaValue));
        return count($aQuery);
    }
}
