import { LoginForm } from './components/ui/LoginForm';

export const LoggedOut = () => (
  <div className='w-64 mx-auto mt-24 p-4 bg-primary shadow-xl'>
    <h1>Willkommen bei Carrot</h1>
    <LoginForm />
  </div>
);
