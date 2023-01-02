import { useMatches } from "react-router-dom";

export const useBreadcrumbs = () => {
  const matches = useMatches();
  return  matches
    .filter((match) => Boolean(match.handle?.crumb))
    .map((match) => match.handle.crumb(match.data));
}
