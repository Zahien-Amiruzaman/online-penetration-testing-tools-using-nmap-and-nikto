<?php

function user_datatables($conn)
{
    $user_data = get_user_data($conn);

    foreach ($user_data as $user) {
        echo <<<HTML
            <tr>
                <td class="text-center">{$user['username']}</td>
                <td class="text-center">{$user['email']}</td>
                <td class="text-center">{$user['user_type']}</td>
                <td class="text-center">{$user['created_time']}</td>
                <td class="col-md-2 text-center">
                    <!-- view button -->
                    <i class="fa-solid fa-eye"
                        style="
                            cursor: pointer;
                            color: grey;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#user_view_modal{$user['user_id']}">
                    </i>
                    <!-- edit button -->
                    <i class="fa-solid fa-pen-to-square"
                        style="
                            cursor: pointer;
                            color: blue;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#user_edit_modal{$user['user_id']}">
                    </i>
                    <!-- delete button -->
                    <i class="fa-solid fa-trash-can"
                        style="
                            cursor: pointer;
                            color: red;
                            padding: 0.2em;
                            font-size: 16px;"
                        data-bs-toggle="modal"
                        data-bs-target="#user_delete_modal{$user['user_id']}">
                    </i>
                </td>
            </tr>
        HTML;
    }
}