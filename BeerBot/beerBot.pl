

test :- write( 'Prolog \nwas called \nfrom PHP \nsuccessfully.' ).

s --> np, verb, np.
s --> np, be_form, complement.
np --> det, noun.
np --> noun.
np --> propernoun.
complement --> np.
complement --> adjective.
det --> [the].
det --> [a].
det --> [all].
noun --> [cat].
noun --> [dog].
noun --> [mammal].
noun --> [cats].
noun --> [dogs].
noun --> [mammals].
verb --> [likes].
verb --> [like].
be_form --> [is].
be_form --> [are].
adjective --> [orange].
adjective --> [furry].
adjective --> [lazy].
propernoun --> [garfield].
propernoun --> [odie].

