import { useState } from 'react';
import { CarrotData } from './types';

const NewRecipeDialog = ({ showNewRecipeDialog, setShowNewRecipeDialog }: any) => (
  <div className='w-screen h-screen bg-gray-dark bg-opacity-90 absolute'>
    <div className='w-fit m-auto mt-4 bg-primary flex flex-col'>
      <div className='flex flex-row flex-nowrap'>
        <span>Hier kannst du ein neues Rezept anlegen</span>
        <button onClick={() => setShowNewRecipeDialog(!showNewRecipeDialog)}>Schließen</button>
      </div>
      <form action="/" method="post" className='flex flex-col'>
        <label htmlFor='title'>Rezepttitel</label>
        <input type="text" id="title" />
        Aufwand
        <label htmlFor='effort0'>gering</label>
        <input type="radio" value="0" name="effort" id="effort0" />
        <label htmlFor='effort0'>mittel</label>
        <input type="radio" value="1" name="effort" id="effort1" />
        <label htmlFor='effort0'>hoch</label>
        <input type="radio" value="2" name="effort" id="effort2" />
        <input type="submit" value="Speichern" />
      </form>
    </div>
  </div>);

export const LoggedIn = ({ carrotData }: { carrotData: CarrotData; }) => {
  const { username } = carrotData;
  const [showNewRecipeDialog, setShowNewRecipeDialog] = useState(false);

  return (
    <>
      {showNewRecipeDialog && <NewRecipeDialog showNewRecipeDialog={showNewRecipeDialog} setShowNewRecipeDialog={setShowNewRecipeDialog} />}
      <div>
        <header className="bg-primary p-4 font-black text-2xl mb-4 justify-between flex">
          Willkommen bei Carrot!
          <form action="/" method="post">
            <input type="hidden" name="logout" value="true" />
            <input type="submit" value="Logout" />
          </form>
        </header>
        <p>
          Hallo {username}!
        </p>
        <button className='rounded-full bg-secondary p-2 font-semibold text-gray-light' onClick={() => setShowNewRecipeDialog(!showNewRecipeDialog)}>Rezept hinzufügen</button>
      </div >
    </>
  );
};
