function swapObject(object) {
  return Object.fromEntries(
    Object.entries(object).map(
      ([key, value]) => [value, key]
    )
  );
}

console.log(swapObject({a: 'b', c: 'd', e: 'f'}));