<?php
    $pf = "public/";
    $userFile = '';
    if (!is_null(\App\Models\WriterMediaProfile::
                        where('writer_id',Auth::guard('web')
        ->user()
        ->id)
        ->first()
        ->media_link)) {

            
        $userFile = str_replace($pf, '', \App\Models\WriterMediaProfile::
                        where('writer_id',Auth::guard('web')
        ->user()
        ->id)
        ->first()
        ->media_link);
    }

    // echo $userFile;


?>