<?php


function list_dir($xx)
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

    $list_docs .= '<li class="FolderClass docResult rootFolder" id="folder_' . $nb . '">
                                <span><img src="../../assets/imgs/dir-close.gif">&nbsp;' . $_SESSION["user_name"] . '</span>
                                                       
                                <div class="contextMenu folder_' . $nb . ' dropdown-menu dropdown-menu-sm" id="context-menu_' . $nb . '" data-name="' . $_SESSION["user_id"] . '" data-position="../../src/users/">
                                    <a class="dropdown-item list-group-item-info" >' . $_SESSION["user_name"] . '</a>
                                    <a class="dropdown-item CreateFolder" href="#">Create Folder</a>
                                </div>                                                
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
            $list_docs .= '<li class="FolderClass docResult" id="folder_' . $nb . '">
                                <span>' . $indent . '<img src="../../assets/imgs/dir-close.gif">&nbsp;' . $filename . '</span>
                                                       
                                <div class="contextMenu folder_' . $nb . ' dropdown-menu dropdown-menu-sm" id="context-menu_' . $nb . '" data-name="' . $filename . '" data-position="' . $path . '">
                                    <a class="dropdown-item list-group-item-info" >' . $filename . '</a>
                                    <a class="dropdown-item renameFolder" href="#">Rename Folder</a>
                                    <a class="dropdown-item DeleteFolder" href="#">Delete Folder</a>
                                    <a class="dropdown-item MoveFolder" href="#" data-toggle="modal" data-target="#exampleModalCenter">Move Folder</a>
                                    <a class="dropdown-item CreateFolder" href="#">Create Folder</a>
                                </div>                                                
                        </li>';
        } else {
            $list_docs .= '<li class="FolderClass docResult" id="folder_' . $nb . '">
                                <span id="file_' . $nb . '">
                                    ' . $indent . '<img src="../../assets/imgs/file-none.gif">&nbsp;' . $file->getFilename() . '
                                </span>
                          
                                <div class="contextMenu folder_' . $nb . ' dropdown-menu dropdown-menu-sm" id="context-menu_' . $nb . '" data-name="' . $filename . '" data-position="' . $path . '" data-type="' . $Ext . '">
                                    <a class="dropdown-item list-group-item-warning" >' . $filename . '</a>
                                    <a class="dropdown-item renameFile" href="#">Rename File</a>
                                    <a class="dropdown-item DeleteFile" href="#">Delete File</a>
                                    <a class="dropdown-item MoveFile" href="#" data-toggle="modal" data-target="#exampleModalCenter">Move File</a>
                                    <a class="dropdown-item DownloadFile" href="#">Download File</a>
                                </div>   
                    
                           </li>';
        }
    }
    $list_docs .= '</ul>';
    return $list_docs;

}