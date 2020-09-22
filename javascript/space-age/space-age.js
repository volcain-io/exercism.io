const ORBITAL_PERIOD_IN_EARTH_YEARS = {
  earth: 1,
  jupiter: 11.862615,
  mars: 1.8808158,
  mercury: 0.2408467,
  neptune: 164.79132,
  saturn: 29.447498,
  uranus: 84.016846,
  venus: 0.61519726,
};
const EARTH_YEAR_IN_SECONDS = 3.15576e7;

const round2digits = (number) => Math.round(number * 100) / 100;

export const age = (planet, seconds) =>
  round2digits(
    seconds / EARTH_YEAR_IN_SECONDS / ORBITAL_PERIOD_IN_EARTH_YEARS[planet]
  );
