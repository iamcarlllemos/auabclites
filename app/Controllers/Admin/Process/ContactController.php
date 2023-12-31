<?php

namespace App\Controllers\Admin\Process;

use App\Controllers\BaseController;
use App\Models\CustomModel;

class ContactController extends BaseController {

    protected $validation;

    public function __construct() {
        $this->validation = \Config\Services::validation();
    }

    public function validation() {
        
        $rule = [
            'fb-link' => [
                'label' => 'Facebook',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters'
                ]
            ],
            'ig-link' => [
                'label' => 'Instagram',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters'
                ]
            ],
            'twi-link' => [
                'label' => 'Twitter',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|min_length[4]|valid_email',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters',
                    'valid_email' => '{field} is an invalid email'
                ]
            ],
            'landline' => [
                'label' => 'Landline',
                'rules' => 'required|min_length[4]|numeric',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters',
                    'numeric' => '{field} must be numeric'
                ]
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'required|min_length[4]|numeric',
                'errors' => [
                    'required' => '{field} cannot be blank',
                    'min_length' => '{field} must be atleast 4 characters',
                    'numeric' => '{field} must be numeric'
                ]
            ],
        ];
   
        if(!$this->validate($rule)) {
            return false;
        } 
        
        return true;

    }
    
    public function update() {
        if($this->request->getMethod() === 'post') {
            if($this->validation()) {
                
                $data = [
                    [   
                        'id' => 1,
                        'value' => $this->request->getPost('fb-link')
                    ],
                    [
                        'id' => 2,
                        'value' => $this->request->getPost('ig-link'),
                    ],
                    [
                        'id' => 3,
                        'value' => $this->request->getPost('twi-link'),
                    ],
                    [
                        'id' => 4,
                        'value' => $this->request->getPost('email'),
                    ],
                    [
                        'id' => 5,
                        'value' => $this->request->getPost('landline'),
                    ],
                    [
                        'id' => 6,
                        'value' => $this->request->getPost('phone')
                    ],
                    [
                        'id' => 7,
                        'value' => $this->request->getPost('address'),
                    ]
                    
                ];

                $model = new CustomModel();

                try {
                    if($model->updateDataBatch('lites_contacts', $data, 'id') > 0) {
                        $flashdata = [
                            'status' => 'success',
                            'message' => 'contact informations successfully updated',
                        ];
                    } else {
                        $flashdata = [
                            'status' => 'error',
                            'message' => 'no changes made',
                        ];
                    }
                } catch (\Exception $e) {
                    $flashdata = [
                        'status' => 'error',
                        'message' => 'error: ' . $e->getMessage(),
                    ];
                }


            } else {
                $message = array_values($this->validator->getErrors());
                $flashdata = [
                    'status' => 'error',
                    'message' => $message,
                ];
            }
            
            session()->setFlashData('flashdata', $flashdata);
            return redirect()->back();
        }
    }

}