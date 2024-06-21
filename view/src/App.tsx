import { LoggedIn } from './LoggedIn';
import { LoggedOut } from './LoggedOut';
import { CarrotData } from './types';

export const App = ({ carrotData }: { carrotData: CarrotData; }) => {
  const { username } = carrotData;

  return username ? <LoggedIn carrotData={carrotData} /> : <LoggedOut />;
};
