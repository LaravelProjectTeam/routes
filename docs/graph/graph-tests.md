## Drawing Tool
https://csacademy.com/app/graph_editor/

## Graph
<Graph indexType="custom" height="400" width="400" nodes={[{options:{circleAttr:{radius:27}},label:"Vratsa",center:{x:199.9,y:121.1}},{options:{circleAttr:{radius:27}},label:"Sofia",center:{x:167.8,y:194.6}},{options:{circleAttr:{radius:27}},label:"Pekin",center:{x:248.9,y:182.6}},{options:{circleAttr:{radius:27}},label:"Pleven",center:{x:217.9,y:258.4}},{options:{circleAttr:{radius:27}},label:"Chirpan",center:{x:297.3,y:246.6}},{options:{circleAttr:{radius:27}},label:"Plovdiv",center:{x:139.9,y:268.2}}]} edges={[{label:"30",source:0,target:1},{label:"2",source:1,target:2},{label:"15",source:2,target:3},{label:"3",source:2,target:4},{label:"10",source:4,target:3}]} />

## Tests

[Vratsa, Vratsa] | from [Vratsa] to [Vratsa] | Distance: 0 - [yes]
[Vratsa, Sofia] | from: [Vratsa] to [Sofia] | Vratsa, Sofia | Distance: 30 - [yes]
[Vratsa, Pekin] | from: [Vratsa] to [Pekin] | Vratsa, Sofia, Pekin | Distance: 32 - [yes]
[Vratsa, Pleven] | from: [Vratsa] to [Pleven] | Vratsa, Sofia, Pekin, Chirpan, Pleven | Distance: 45 - [yes]
[Vratsa, Chirpan] | from: [Vratsa] to [Chirpan] | Vratsa, Sofia, Pekin, Chirpan | Distance: 35 - [yes]
[Vratsa, Plovdiv] | path from Vratsa to Plovdiv does not exist - [yes]

[Sofia, Vratsa] | from: [Sofia] to [Vratsa] | Sofia, Vratsa | Distance: 30 - [yes]
[Sofia, Sofia] | from [Sofia] to [Sofia] | Distance: 0 - [yes]
[Sofia, Pekin] | from: [Sofia] to [Pekin] | Sofia, Pekin | Distance: 2 - [yes]
[Sofia, Pleven] | from: [Sofia] to [Pleven] | Sofia, Pekin, Chirpan, Pleven | Distance: 15 - [yes]
[Sofia, Chirpan] | from: [Sofia] to [Chirpan] | Sofia, Pekin, Chirpan | Distance: 5 - [yes]
[Sofia, Plovdiv] | path from Sofia to Plovdiv does not exist - [yes]

[Pekin, Vratsa] | from: [Pekin] to [Vratsa] | Pekin, Sofia, Vratsa | Distance: 32 - [yes]
[Pekin, Sofia] | from: [Pekin] to [Sofia] | Pekin, Sofia | Distance: 2 - [yes]
[Pekin, Pekin] | 0 - [yes]
[Pekin, Pleven] | from: [Pekin] to [Pleven] | Pekin, Chirpan, Pleven | Distance: 13  - [yes]
[Pekin, Chirpan] | from: [Pekin] to [Chirpan] | Pekin, Chirpan | Distance: 3 - [yes]
[Pekin, Plovdiv] | path from Pekin to Plovdiv does not exist - [yes]

[Pleven, Vratsa] | from: [Pleven] to [Vratsa] | Pleven, Chirpan, Pekin, Sofia, Vratsa | Distance: 45 - [yes]
[Pleven, Sofia] | from: [Pleven] to [Sofia] | Pleven, Chirpan, Pekin, Sofia | Distance: 15 - [yes]
[Pleven, Pekin] | from: [Pleven] to [Pekin] | Pleven, Chirpan, Pekin | Distance: 13 - [yes]
[Pleven, Pleven] | 0 - [yes]
[Pleven, Chirpan] | from: [Pleven] to [Chirpan] | Pleven, Chirpan | Distance: 10 - [yes]
[Pleven, Plovdiv] | path from Pleven to Plovdiv does not exist - [yes]

[Chirpan, Vratsa] | from: [Chirpan] to [Vratsa] | Chirpan, Pekin, Sofia, Vratsa | Distance: 35 - [yes]
[Chirpan, Sofia] | from: [Chirpan] to [Sofia] | Chirpan, Pekin, Sofia | Distance: 5 - [yes]
[Chirpan, Pekin] | from: [Chirpan] to [Pekin] | Chirpan, Pekin | Distance: 3 - [yes]
[Chirpan, Pleven] | from: [Chirpan] to [Pleven] | Chirpan, Pleven | Distance: 10 - [yes]
[Chirpan, Chirpan] | 0 - [yes]
[Chirpan, Plovdiv] | path from Chirpan to Plovdiv does not exist - [yes]

[Plovdiv, Vratsa] | path from Plovdiv to ... does not exist - [yes]
[Plovdiv, Sofia] | path from Plovdiv to ... does not exist - [yes]
[Plovdiv, Pekin] | path from Plovdiv to ... does not exist - [yes]
[Plovdiv, Pleven] | path from Plovdiv to ... does not exist - [yes]
[Plovdiv, Chirpan] | path from Plovdiv to ... does not exist - [yes]
[Plovdiv, Plovdiv] | 0 - [yes]
