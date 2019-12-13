import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Form, Button, Col, Row } from 'react-bootstrap';
import ErrorMessage from "./errorMessage";
import axios from 'axios';
import { useHistory } from 'react-router-dom';
//import { submitSignup } from 'src/store/register/actions';

import useForm from "react-hook-form";

// import sass
import './style.sass';



const Signup = (props) => {

    let history = useHistory();

    const activeState = useSelector(state => ({
        ...state.registerReducer,
    }));

    const dispatch = useDispatch();

    const [userInfo, setUserInfo] = useState({
        username: '',
        email: '',
        birth: '',
        password: '',
        password_confirmation: '',
        formSuccess: false

    });

    const {
        register,
        handleSubmit,
        errors,
        setError,
        clearError,
        formState: { isSubmitting }
      } = useForm();

    const onSubmit = (data) => {

        console.log(JSON.stringify({...activeState}));
        axios.post('http://127.0.0.1:8000/user/register',
          JSON.stringify({...activeState}), {
            headers: {
                'Content-Type': 'application/json',
            }
        }
          )
          .then(function (response) {
            if(response.status === 200) {
                dispatch({
                    type: `SUBMIT_SIGNUP`
                  });
                console.log("submit",{...activeState});  
                history.push("/signin");
                // Response 200 donc on redirige sur /signin
            }
            else {
                alert('une erreur est survenu lors de l\'inscription');
            }})
          .catch(function (error) {
            console.log(error.response.status);
            let errorFromServ;
            errorFromServ = Object.entries(error.response.data[0]);
            alert(errorFromServ);
          });
    };

    const handleChangeInput = (event) => {
        const property = event.target.id;
        dispatch({
          type: `CHANGE_${property.toUpperCase()}`,
          data: event.target.value
        });

      };

    return <div className="signup">
        <div className="signup-container">
            <div className="signup-form">
                <Form onSubmit={handleSubmit(onSubmit)}>
                    <Row className="justify-content-center">
                        <Col lg={5} md={6} sm={8} xs={10}>
                        <Form.Group controlId="username">
                            <Form.Label>Pseudo* </Form.Label>
                            <Form.Control name="userName" type="text" placeholder="Pseudo" className="form-input" onChange={handleChangeInput} ref={register({ required: true, maxLength: 24, minLength: 2 })}/>
                            <ErrorMessage error={errors.userName} />
                            
                        </Form.Group>

                        <Form.Group controlId="email">
                            <Form.Label>mail*</Form.Label>
                            <Form.Control name="email" type="email" placeholder="Mail" className="form-input" onChange={handleChangeInput} ref={register({ required: true, pattern: /^\S+@\S+.+[a-z]+$/i  })}/>
                            <ErrorMessage error={errors.email} />
                            <Form.Text className="text-muted">
                                Nous ne partagerons jamais vos informations
                            </Form.Text>
                        </Form.Group>

                        <Form.Group controlId="birthdate">
                            <Form.Label>Date de naissance*</Form.Label>
                            <Form.Control name="birthdate" type="date" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.birthdate} />
                        </Form.Group>
                        

                        <Form.Group controlId="password">
                            <Form.Label>Mot de passe*</Form.Label>
                            <Form.Control name="password" type="password" placeholder="Mot de passe" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.password} />
                        </Form.Group>

                        <Form.Group controlId="verifpassword">
                            <Form.Label>Mot de passe*</Form.Label>
                            <Form.Control name="verifPassword" type="password" placeholder="Mot de passe" className="form-input" onChange={handleChangeInput} ref={register({ required: true })}/>
                            <ErrorMessage error={errors.verifPassword} />
                        </Form.Group>

                        <Form.Group controlId="formBasicCheckbox">
                            <Form.Check name="checkbox" type="checkbox" label="J'accepte les conditions générales d'utilisation" ref={register({ required: true })}/>
                            <ErrorMessage error={errors.checkbox} />
                        </Form.Group>
                        </Col>
                    </Row>
                    <Row className="justify-content-center">
                        <Col lg={3} md={6} sm={8} xs={10}>  
                            <Button variant="primary" type="submit" className="btn-main btn-submit">
                                s'inscrire
                            </Button>
                        </Col>
                    </Row>   
                </Form> 
            </div>
        </div>
    </div>;
};

export default Signup