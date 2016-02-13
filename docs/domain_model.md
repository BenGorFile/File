#Domain Model
This component provides a file main model containing domain logic that allows handling common use cases. This domain 
class is extendable to allow custom use cases. Furthermore, it exists two interfaces to represents the real file itself
and filesystem. Also multiple value object have been created with their own encapsulated logic.
 
##File
Main domain file that it is needed to resolve some common use cases.

##UploadedFile
Uploaded file interface that represents the physical and real file.

##FileSystem
Abstraction layer that allows common actions over uploaded file.
