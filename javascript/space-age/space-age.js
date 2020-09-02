const PLANET_EARTH_YEARS = {
  earth: 1,
  jupiter: 11.862615,
  mars: 1.8808158,
  mercury: 0.2408467,
  neptune: 164.79132,
  saturn: 29.447498,
  uranus: 84.016846,
  venus: 0.61519726,
};
const EARTH_YEAR_IN_SECONDS = 31557600;

export const age = (planet, seconds) =>
  Number(
    (seconds / EARTH_YEAR_IN_SECONDS / PLANET_EARTH_YEARS[planet]).toFixed(2)
  );
