export default function transform(oldObject) {
  const newObject = {};
  for (const property in oldObject) {
    oldObject[property].every(value => newObject[value.toLowerCase()] = Number.parseInt(property));
  }
  return newObject;
}
