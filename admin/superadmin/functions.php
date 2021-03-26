<?php



function redirect($url) {

    echo "<script language=\"JavaScript\">\n";
    echo "<!-- hide from old browser\n\n";

    echo "window.location = \"" . $url . "\";\n";

    echo "-->\n";
    echo "</script>\n";

    return true;
}

function set_rights($menus, $menuRights, $topmenu) {
    $data = array();

    for ($i = 0, $c = count($menus); $i < $c; $i++) {


        $row = array();
        for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
            if ($menuRights[$j]["rr_modulecode"] == $menus[$i]["mod_modulecode"]) {
                if (authorize($menuRights[$j]["rr_create"]) || authorize($menuRights[$j]["rr_edit"]) ||
                        authorize($menuRights[$j]["rr_delete"]) || authorize($menuRights[$j]["rr_view"])  || authorize($menuRights[$j]["rr_approval"]) 
                ) {
   
                    $row["menu"] = $menus[$i]["mod_modulegroupcode"]; 
                    $row["menu_name"] = $menus[$i]["mod_modulename"];
                    $row["page_name"] = $menus[$i]["mod_modulepagename"];


                    $row["sub"] = $menus[$i]["subcode"];

             
                    $row["create"] = $menuRights[$j]["rr_create"];
                    $row["edit"] = $menuRights[$j]["rr_edit"];
                    $row["delete"] = $menuRights[$j]["rr_delete"];
                    $row["view"] = $menuRights[$j]["rr_view"];
          $row["approval"] = $menuRights[$j]["rr_approval"];

                    $data[$menus[$i]["mod_modulegroupcode"]][$menuRights[$j]["rr_modulecode"]] = $row;
                 

                    $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_name"] = $menus[$i]["mod_modulegroupname"];


                   // $data[$menus[$i]["subcode"]]["sub_menu_name"] = $menus[$i]["subname"];
                   
                    //$data[$menus[$i]["subcode"]][$menuRights[$j]["rr_modulecode"]] = $row;
                    //$data[$menus[$i]["subcode"]]["top_menu_name"] = $menus[$i]["subname"];

                }
            }
        }




        
    }
    
    return $data;
}

function authorize($module) {
    return $module == "yes" ? TRUE : FALSE;
}

?> 




