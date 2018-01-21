HandyCom
========================
Back-end + front-end for the web landing pages editor http://thibautbremand.fr/HandycomEng <br/>
**Demo :** http://thibautbremand.fr/HandycomEng <br/>

**Installation :** <br/>
- Clone the repo in your php server.

**More details :** <br/>
- The back-end is service oriented, the php services are in the *webservices* folder.
- All the external plugins used are in the *plugins* folder.
- The different templates available are in the *templates* folder.
- The drafts are saved into the *drafts* folder. It contains one folder per user with all the saved drafts.
- *Control*, *Model* and *View* folders follow the MVC architecture, and contain the code for the Editor part of the website (not the landing which is independent).
- *PageFiller* contain all the .part files needed by the editor to build the customized templates.
