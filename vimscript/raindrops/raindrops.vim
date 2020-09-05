"
" Convert a number to a string, the contents of which depend on the number's
" factors.
"
"   - If the number has 3 as a factor, output 'Pling'.
"   - If the number has 5 as a factor, output 'Plang'.
"   - If the number has 7 as a factor, output 'Plong'.
"   - If the number does not have 3, 5, or 7 as a factor, just pass
"     the number's digits straight through.
"
" Example:
"
"   :echo Raindrops(15)
"   PlingPlang
"
function! Raindrops(number) abort
  let raindrops = { 3: 'Pling', 5: 'Plang', 7: 'Plong' }
  let result = []

  for factor in keys(raindrops)
     if a:number % factor == 0
        call add(result, raindrops[factor])
     endif
  endfor

  return empty(result) ? string(a:number) : join(result, "")
endfunction
