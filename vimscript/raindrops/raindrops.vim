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
  let l:raindrops = { 3: 'Pling', 5: 'Plang', 7: 'Plong' }
  let l:result = []

  for l:factor in keys(l:raindrops)
     if a:number % l:factor == 0
        call add(l:result, l:raindrops[factor])
     endif
  endfor

  return empty(l:result) ? string(a:number) : join(l:result, "")
endfunction
