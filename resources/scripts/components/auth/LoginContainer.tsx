import React, { useEffect } from 'react';
import { RouteComponentProps } from 'react-router-dom';

const LoginContainer = ({ history }: RouteComponentProps) => {
    useEffect(() => {
        window.location.href = '/auth/login/sso';
    }, []);

    return null;
};

export default LoginContainer;

