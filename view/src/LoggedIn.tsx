import { useState } from 'react';
import { CarrotData } from './types';

const NewRecipeDialog = ({ showNewRecipeDialog, setShowNewRecipeDialog }: any) => (
  <div className='w-screen h-screen bg-gray-dark bg-opacity-90 absolute'>
    <div className='blur-none'>
      Hier kannst du ein neues Rezept anlegen
      <button onClick={() => setShowNewRecipeDialog(!showNewRecipeDialog)}>Schließen</button>
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
