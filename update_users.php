<?php
    ...
    if($_SESSION['authenticate']['lvl'] != 3):
        echo "<span class='title'>Author
            <select class='title' disabled>
            <option value=\"{$_SESSION['authenticate']['id']}\" disabled selected>{$_SESSION['authenticate']['user']}</option>
        </select></span>";
    else:
?>
    <label>
        <span class="title">Autor</span>
        <select name="id_auth" class="title">
            <option value="null">Pick an author:</option>
                <?php
                    $readAuth = new Read();
                    $readAuth->query("SELECT DISTINCT u.id AS id_auth,
                        p.id_auth, u.name AS author 
                        FROM users u LEFT JOIN post p ON u.id = p.id_auth");

                    if(!$readAuth->result()):
                         echo "<option disabled='disabled'>No authors found.</option>";
                    else:
                        foreach($readAuth->result() AS $authors):
                          echo "<option value=\"{$auth['id_auth']}\" ";
                          if($authors['id_auth'] == $post['id_auth']):
                              echo " selected=\"selected\"  ";
                              if($post['id_auth'] > 2):
                                  $readAuth->query("SELECT DISTINCT u.id AS id_auth,
                                      p.id_auth, u.name AS author FROM users u 
                                      LEFT JOIN post p ON u.id = p.id_auth
                                      WHERE u.id > 2");
                                if($readAuth->result()):
                                    foreach($readAuth->resultado() AS $thisAuth):
                                        echo "<option disabled=\"disabled\" selected=\"selected\">{$thisAuth['auth']}</option>";
                                    endforeach;
                                endif;
                              endif;
                            endif;
                          echo " style = 'color:black;'><b> &rsaquo; </b>{$authors['auth']}</option>";
                        endforeach;
?>
