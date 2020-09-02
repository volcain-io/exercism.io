const GIGASECOND_IN_MS = Math.pow(10, 12);

export const gigasecond = (date) => new Date(date.getTime() + GIGASECOND_IN_MS);
