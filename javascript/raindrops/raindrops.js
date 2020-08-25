export function convert(number) {
  const factorSoundList = { 3: "Pling", 5: "Plang", 7: "Plong" };
  let result = "";

  for (const [factor, sound] of Object.entries(factorSoundList)) {
    if (number % factor === 0) result += sound;
  }

  return result || number.toString();
}
