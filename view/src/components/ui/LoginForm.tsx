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
        <label>Login</label>
        <input className="form-input" {...register("login", { required: true })} />
        <label>Password</label>
        <input className="form-input" type="password" {...register("password", { required: true })} />
        <input type="submit" value="Anmelden" />
    </form>;
};