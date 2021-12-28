
# railroad/addevent-manager

Also see
* railroad/musora (current usage)
* new components to replace parts or God-Object in railroad/musora
  * railroad/addevent-sdk (COMPLETE)
  * railroad/addevent-manager (this, WIP)
  * railroad/addevent-cli (WIP)

## Overview of components, Simplified

1. Listener for content, content-datum, content-field changes
2. Primary Eval function
3. Process content requiring event creation
4. Create or update event

## Overview of components, with details

### Listener for content, content-datum, content-field changes 
   1. uses same Events-and-Listeners as current AddEvent handling in railroad/musora
   2. stores content-ids to cache ("ToEvalForAddEvent" or something like that)

### Primary Eval command

1. cron triggered
2. determine content needing creation
    1. from cache get content-ids ("ToEvalForAddEvent" or something like that)
    2. query DB (musora_laravel.addevent3)
    3. determine content-ids withOUT DB results
       1. save to "content_needing_addevent_events" cache
3. determine content needing update
    1. content-ids WITH DB results have AddEventContent object created
       1. object has these properties determined in constructor:
          1. title
          2. description
          3. start time
          5. hash (of title, description, and start time)
          4. calendars (ids of the specific content-type-specific and brand-overview calendars for this content's event)
    2. each AddEventDetail->hash() compared to DB record
       1. DO match: content-id deleted from the "ToEvalForAddEvent" cache list
       2. do NOT match: passed to UpdateEvent

### Process the content requiring event creation

1. triggered by cron 
2. get content ids from cache ("content_needing_addevent_events" or something like that)
3. call CreateEvent
 
### CreateEvent

2. create event
3. save to DB
   1. content id
   2. event id
   3. AddEventContent->hash value 
4. remove from cache
   
### UpdateEvent

2. get existing event info from DB
3. update event
4. save to DB
    1. content id
    2. event id
    3. AddEventContent->hash value
5. remove from cache?
      
note, the create and update event functions might allow use to just use what we currently have and thus we'd only need to update the triggering mechanism...?

## Building Tests for TDD

### Primary Eval function
1. set up
   1. create dummy content
      1. content withOUT preexisting events
      2. content WITH preexisting events, NOT needing updates
      3. content WITH preexisting events, NEEDING updates
   2. create dummy DB data
      1. How to handle DB?
         1. Mock?
            1. prepare dummy date
               1. determine values for "initial select" data
            2. define expectations on mock
               1. expect SELECT, will return "initial select" data
         2. in-memory?
         3. actual? bleh!
   3. determine sets of contents to be returned or expected by cache mock
      1. for ToEvalForAddEvent
      2. for content_needing_addevent_events
      3. content not requring updates (for "ToEvalForAddEvent" cache list deletion calls)
   4. create cache mock
      1. expect one call for "ToEvalForAddEvent", will return set of content ids
      2. expect one call for "content_needing_addevent_events", will return appropriate set of content ids
      3. expect "ToEvalForAddEvent" cache list deletion calls with above-determined set of content-ids 
   5. create mock for UpdateEvent
      1. determine expected content details to be passed
      2. set expectations on mock
2. trigger system under test
   1. call command
   2. determine content needing creation
       1. from cache get content-ids ("ToEvalForAddEvent" or something like that)
       2. query DB (musora_laravel.addevent3)
       3. determine content-ids withOUT DB results
           1. save to "content_needing_addevent_events" cache (**TEST: assert select content ids sent to this mock**)
   3. determine content needing update
       1. content-ids WITH DB results have AddEventContent object created
           1. object has these properties determined in constructor: (**note in test, do not assert AddEventContent objects created with select ids, rather the outcome of the test verifies that this is working correctly**)
               1. title
               2. description
               3. start time
               5. hash (of title, description, and start time)
               4. calendars (ids of the specific content-type-specific and brand-overview calendars for this content's event)
       2. each AddEventDetail->hash() compared to DB record
           1. DO match: content-id deleted from the "ToEvalForAddEvent" cache list (**TEST: assert cache mock delete method called with select ids**)
           2. do NOT match: passed to UpdateEvent (**TEST: assert UpdateEvent called with select ids**)

### create or update event       

WIP
