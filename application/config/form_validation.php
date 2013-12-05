<?php $config = array(
               array(
                     'field'   => 'firstname',
                     'label'   => 'Username',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'lastname',
                     'label'   => 'Lastname',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'passconf',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'valid_email|required'
                  )
            );

  ?>