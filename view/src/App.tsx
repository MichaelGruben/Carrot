import './App.css';
import { CarrotData } from './types';
import { LoginForm } from './components/LoginForm';

const App = ({ carrotData }: { carrotData: CarrotData }) => {
  const { username } = carrotData;

  return (
    <div className="App">
      <header className="App-header">
        Willkommen bei Carrot!
        {username && <form action="/" method="post">
          <input type="hidden" name="logout" value="true" />
          <input type="submit" value="Logout" />
        </form>}
      </header>
      {username ? <p>
        Hallo {username}!
      </p> : <LoginForm />}
    </div>
  );
}

export default App;
