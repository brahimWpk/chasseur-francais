var elem = document.createElement('script');
elem.src = 'https://quantcast.mgr.consensu.org/cmp.js';
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
(function() {
	var gdprAppliesGlobally = true;
	function addFrame() {
		if (!window.frames['__cmpLocator']) {
			if (document.body) {
				var body = document.body,
				iframe = document.createElement('iframe');
				iframe.style = 'display:none';
				iframe.name = '__cmpLocator';
				body.appendChild(iframe);
			} else {
				// In the case where this stub is located in the head,
				// this allows us to inject the iframe more quickly than
				// relying on DOMContentLoaded or other events.
				setTimeout(addFrame, 5);
			}
		}
	}
	addFrame();
	function cmpMsgHandler(event) {
		var msgIsString = typeof event.data === "string";
		var json;
		if(msgIsString) {
			json = event.data.indexOf("__cmpCall") != -1 ? JSON.parse(event.data) : {};
		} else {
			json = event.data;
		}
		if (json.__cmpCall) {
			var i = json.__cmpCall;
			window.__cmp(i.command, i.parameter, function(retValue, success) {
				var returnMsg = {"__cmpReturn": {
						"returnValue": retValue,
						"success": success,
						"callId": i.callId
					}
				};
				event.source.postMessage(msgIsString ?
				JSON.stringify(returnMsg) : returnMsg, '*');
			});
		}
	}
	window.__cmp = function (c) {
		var b = arguments;
		if (!b.length) {
			return __cmp.a;
		}
		else if (b[0] === 'ping') {
			b[2]({"gdprAppliesGlobally": gdprAppliesGlobally,
			"cmpLoaded": false}, true);
		} else if (c == '__cmp')
			return false;
		else {
			if (typeof __cmp.a === 'undefined') {
				__cmp.a = [];
			}
			__cmp.a.push([].slice.apply(b));
		}
	}
	window.__cmp.gdprAppliesGlobally = gdprAppliesGlobally;
	window.__cmp.msgHandler = cmpMsgHandler;
	if (window.addEventListener) {
		window.addEventListener('message', cmpMsgHandler, false);
	}
	else {
		window.attachEvent('onmessage', cmpMsgHandler);
	}
})();

post_consent_page = ( site_config_js && site_config_js['is_preprod'] ) ? 'renovation.rw.webpick.info' : 'www.maison-travaux.fr';

var accept_button_text = (site_config_js.devs.ajustements_css_rgpd_158942863) ? 'Continuer sur le site' : "J'accepte" ;
var purpose_link_text = (site_config_js.devs.ajustements_css_rgpd_158942863) ? 'Paramétrer les cookies' : 'Afficher toutes les utilisations prévues' ;
window.__cmp('init', {
	'Language': 'fr',
	'Initial Screen Title Text': 'Le respect de votre vie privée est notre priorité',
	'Initial Screen Reject Button Text': 'Je refuse',
	'Initial Screen Accept Button Text': accept_button_text,
	'Initial Screen Purpose Link Text': purpose_link_text,
	'Purpose Screen Title Text': 'Le respect de votre vie privée est notre priorité',
	'Purpose Screen Header Title Text': 'Paramètres de Gestion de la Confidentialité',
	'Purpose Screen Body Text': 'Vous pouvez configurer vos réglages et choisir comment vous souhaitez que vos données personnelles soient utilisée en fonction des objectifs ci-dessous. Vous pouvez configurer les réglages de manière indépendante pour chaque partenaire. Vous trouverez une description de chacun des objectifs sur la façon dont nos partenaires et nous-mêmes utilisons vos données personnelles.',
	'Purpose Screen Enable All Button Text': 'Consentement à toutes les utilisations prévues',
	'Purpose Screen Vendor Link Text': 'Afficher la liste complète des partenaires',
	'Purpose Screen Cancel Button Text': 'Annuler',
	'Purpose Screen Save and Exit Button Text': 'Enregistrer et quitter',
	'Vendor Screen Title Text': 'Le respect de votre vie privée est notre priorité',
	'Vendor Screen Body Text': "Vous pouvez configurer vos réglages indépendamment pour chaque partenaire listé ci-dessous. Afin de faciliter votre décision, vous pouvez développer la liste de chaque entreprise pour voir à quelles fins il utilise les données. Dans certains cas, les entreprises peuvent révéler qu'elles utilisent vos données sans votre consentement, en fonction de leurs intérêts légitimes. Vous pouvez cliquer sur leurs politiques de confidentialité pour obtenir plus d'informations et pour vous désinscrire.",
	'Vendor Screen Accept All Button Text': 'Tout Accepter',
	'Vendor Screen Reject All Button Text': 'Tout Refuser',
	'Vendor Screen Purposes Link Text': 'Revenir aux paramètres',
	'Vendor Screen Cancel Button Text': 'Annuler',
	'Vendor Screen Save and Exit Button Text': 'Enregistrer et quitter',
	'Initial Screen Body Text': 'Nos partenaires et nous-mêmes utilisent différentes technologies, telles que les cookies, pour personnaliser les contenus et les publicités, proposer des fonctionnalités sur les réseaux sociaux et analyser le trafic. Merci de cliquer sur le bouton ci-dessous pour donner votre accord. Vous pouvez changer d’avis et modifier vos choix à tout moment',
	'Initial Screen Body Text Option': 1,
	'Publisher Name': 'Reworld Media',
	'Display UI': 'always',
	'Publisher Purpose IDs': [1,2,3,4,5],
	'Post Consent Page': 'http://' + post_consent_page + '/politique-utilisation-cookies',
	'UI Layout': 'banner',
	'No Option': false,
	'Publisher Purpose Legitimate Interest IDs': [1,2,3,4,5],
	'Non-Consent Display Frequency': 30,
} );
