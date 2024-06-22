import { useForm } from "react-hook-form";

type Inputs = {
    login: string
    password: string
}

export const LoginForm = () => {

    const {
        register,
    } = useForm<Inputs>();
    return <form action="/" method="POST">
        <label htmlFor="login">Login</label>
        <input id="login" className="form-input" {...register("login", { required: true })} />
        <label htmlFor="password">Password</label>
        <input id="password" className="form-input" type="password" {...register("password", { required: true })} />
        <input type="submit" value="Anmelden" />
    </form>;
};