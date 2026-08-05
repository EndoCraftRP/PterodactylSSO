import React, { useEffect } from 'react';
import { RouteComponentProps } from 'react-router-dom';

const LoginContainer = ({ history }: RouteComponentProps) => {
    useEffect(() => {
        // Redirige vers '/auth/login/sso' lorsque le composant est monté
        window.location.href = '/auth/login/sso';
    }, []);

    // Ne retourne aucun contenu
    return null;
};

export default LoginContainer;

