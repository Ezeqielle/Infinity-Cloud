<?php


function list_dir_modal($xx)
{

    $list_docs = '<ul>';
    $nb = 1;
    $read_folder = $xx;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($read_folder, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
        RecursiveIteratorIterator::CATCH_GET_CHILD// Ignore "Permission denied"
    );


//    define root

    $list_docs .= ' <li class="Target FolderClass docResult rootFolder" id="folder_' . $nb . '" data-position="../../src/users/' . $_SESSION["user_id"] . '" data-name="' . $_SESSION["user_id"] . '" >
                        <span><img src="../../assets/imgs/dir-close.gif">&nbsp;' . $_SESSION["user_name"] . '</span>                                                   
                    </li>';

//    end define root

    foreach ($iterator as $file) {
        $filename = $file->getFilename();
        $pathname = $file->getPathname();
        $path = $file->getPath();
        $Size = $file->getSize();
        $Type = $file->getType();
        $Ext = $file->getExtension();

        $nb++;

        $indent = str_repeat('&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp', $iterator->getDepth());
        if ($file->isDir()) {
            $list_docs .= '<li class="Target FolderClass docResult" id="folder_' . $nb . '" data-position="' . $pathname . '"data-name="' . $filename . '">
                                <span>' . $indent . '<img src="../../assets/imgs/dir-close.gif">&nbsp;' . $filename . '</span>                                              
                        </li>';
        }
    }
    $list_docs .= '</ul>';
    return $list_docs;

}