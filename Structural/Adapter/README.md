# `Adapter` 

> Ayrıca şöyle bilinir: Wrapper 

## Niyet 

**Adapter, uyumsuz arayüzlere sahip nesnelerin ortak çalışmasına izin veren yapısal bir tasarım kalıbıdır.**

![alt text](https://refactoring.guru/images/patterns/content/adapter/adapter-en.png "Adapter")

## Sorun 

Bir borsa izleme uygulaması oluşturduğunuzu hayal edin. Uygulama, hisse senedi verilerini birden çok kaynaktan XML biçiminde indirir ve ardından kullanıcı için hoş görünümlü çizelgeler ve diyagramlar görüntüler.

Bir noktada, akıllı bir 3. taraf analitik kitaplığı entegre ederek uygulamayı geliştirmeye karar veriyorsunuz. Ancak bir püf noktası var: Analitik kitaplığı yalnızca JSON biçimindeki verilerle çalışır.

![alt text](https://refactoring.guru/images/patterns/diagrams/adapter/problem-en.png "Adapter")
> Verilerin uygulamanızla uyumsuz bir biçimde olmasını beklediği için analiz kitaplığını "olduğu gibi" kullanamazsınız.

Kütüphaneyi XML ile çalışacak şekilde değiştirebilirsiniz. Ancak bu, kitaplığa dayanan bazı mevcut kodları bozabilir. Daha da kötüsü, kütüphanenin kaynak koduna erişiminiz olmayabilir ve bu da bu yaklaşımı imkansız hale getirir.

## Çözüm 

Bir adaptör oluşturabilirsiniz. Bu, bir nesnenin arayüzünü başka bir nesnenin anlayabilmesi için dönüştüren özel bir nesnedir.

Bir adaptör, sahne arkasında meydana gelen dönüştürmenin karmaşıklığını gizlemek için nesnelerden birini sarar. Sarılmış nesne, bağdaştırıcının farkında bile değildir. Örneğin, metre ve kilometre cinsinden çalışan bir nesneyi, tüm verileri fit ve mil gibi emperyal birimlere dönüştüren bir adaptörle sarabilirsiniz.

Adaptörler, verileri yalnızca çeşitli biçimlere dönüştürmekle kalmaz, aynı zamanda farklı arabirimlere sahip nesnelerin işbirliği yapmasına da yardımcı olabilir. İşte nasıl çalıştığı:

1. Adaptör, mevcut nesnelerden biriyle uyumlu bir arabirim alır.
2. Bu arabirimi kullanarak, mevcut nesne adaptörlerinin yöntemlerini güvenle çağırabilir.
3. Adaptör, bir çağrı aldıktan sonra isteği ikinci nesneye iletir, ancak ikinci nesnenin beklediği biçim ve sırada.

Bazen aramaları her iki yöne çevirebilen iki yönlü bir adaptör oluşturmak bile mümkündür.

![alt text](https://refactoring.guru/images/patterns/diagrams/adapter/solution-en.png "Adapter")

Borsa uygulamamıza geri dönelim. Uyumsuz biçimler ikilemini çözmek için, kodunuzun doğrudan birlikte çalıştığı analitik kitaplığının her sınıfı için XML'den JSON'a bağdaştırıcılar oluşturabilirsiniz. Ardından, kodunuzu yalnızca bu adaptörler aracılığıyla kitaplıkla iletişim kuracak şekilde ayarlarsınız. Bir adaptör bir çağrı aldığında, gelen XML verilerini bir JSON yapısına çevirir ve çağrıyı, sarılmış bir analitik nesnesinin uygun yöntemlerine iletir.

## Gerçek Dünya Analojisi
![alt text](https://refactoring.guru/images/patterns/content/adapter/adapter-comic-1-en.png "Adapter")
> Yurtdışı seyahatinden önce ve sonra bavul.

ABD'den Avrupa'ya ilk kez seyahat ettiğinizde, dizüstü bilgisayarınızı şarj etmeye çalışırken bir sürprizle karşılaşabilirsiniz. Güç fişi ve priz standartları farklı ülkelerde farklıdır. Bu yüzden ABD fişiniz bir Alman prizine uymuyor. Sorun, Amerikan tipi soket ve Avrupa tipi fişe sahip bir elektrik fişi adaptörü kullanılarak çözülebilir.

## Structure
**Object adapter**

Bu uygulama, nesne oluşturma ilkesini kullanır: adaptör, bir nesnenin arayüzünü uygular ve diğerini sarar. Tüm popüler programlama dillerinde uygulanabilir.

![alt text](https://refactoring.guru/images/patterns/diagrams/adapter/structure-object-adapter.png "Adapter")

1. Client, programın mevcut iş mantığını içeren bir sınıftır.
2. Client Arabirimi, Client koduyla işbirliği yapabilmek için diğer sınıfların izlemesi gereken bir protokolü tanımlar.
3. Hizmet, yararlı bir sınıftır (genellikle 3. taraf veya eski). İstemci, uyumsuz bir arayüze sahip olduğu için bu sınıfı doğrudan kullanamaz.
4. Adaptör, hem istemci hem de hizmetle çalışabilen bir sınıftır: hizmet nesnesini sararken istemci arabirimini uygular. Adaptör, Adaptör arabirimi aracılığıyla istemciden gelen aramaları alır ve bunları, anlayabileceği bir biçimde sarılmış hizmet nesnesine yapılan çağrılara çevirir.
5. İstemci kodu, bağdaştırıcıyla istemci arabirimi aracılığıyla çalıştığı sürece somut adaptör sınıfına bağlanmaz. Bu sayede, mevcut müşteri kodunu bozmadan programa yeni tip adaptörlar tanıtabilirsiniz. Bu, hizmet sınıfının arabirimi değiştiğinde veya değiştirildiğinde yararlı olabilir: istemci kodunu değiştirmeden yeni bir bağdaştırıcı sınıfı oluşturabilirsiniz.

**Class adapter**

Bu uygulama kalıtımı kullanır: adaptör, arabirimleri aynı anda her iki nesneden devralır. Bu yaklaşımın yalnızca C++ gibi çoklu kalıtımı destekleyen programlama dillerinde uygulanabileceğini unutmayın.

![alt text](https://refactoring.guru/images/patterns/diagrams/adapter/structure-class-adapter.png "Adapter")

Sınıf Adaptör, hem istemciden hem de hizmetten davranışları devraldığı için herhangi bir nesneyi sarması gerekmez. Uyarlama, geçersiz kılınan yöntemler içinde gerçekleşir. Ortaya çıkan adaptör, varolan bir istemci sınıfının yerine kullanılabilir.

## Sözde kod 

Adaptör modelinin bu örneği, kare mandallar ve yuvarlak delikler arasındaki klasik çatışmaya dayanmaktadır.

![alt text](https://refactoring.guru/images/patterns/diagrams/adapter/example.png "Adapter")
> Kare mandalları yuvarlak deliklere uyarlama.

Adaptör, yarıçapı karenin çapının yarısına (başka bir deyişle, kare pimi barındırabilen en küçük dairenin yarıçapı) eşit olan yuvarlak bir çivi gibi davranır.

```java

// Say you have two classes with compatible interfaces:
// RoundHole and RoundPeg.
class RoundHole is
    constructor RoundHole(radius) { ... }

    method getRadius() is
        // Return the radius of the hole.

    method fits(peg: RoundPeg) is
        return this.getRadius() >= peg.getRadius()

class RoundPeg is
    constructor RoundPeg(radius) { ... }

    method getRadius() is
        // Return the radius of the peg.


// But there's an incompatible class: SquarePeg.
class SquarePeg is
    constructor SquarePeg(width) { ... }

    method getWidth() is
        // Return the square peg width.


// An adapter class lets you fit square pegs into round holes.
// It extends the RoundPeg class to let the adapter objects act
// as round pegs.
class SquarePegAdapter extends RoundPeg is
    // In reality, the adapter contains an instance of the
    // SquarePeg class.
    private field peg: SquarePeg

    constructor SquarePegAdapter(peg: SquarePeg) is
        this.peg = peg

    method getRadius() is
        // The adapter pretends that it's a round peg with a
        // radius that could fit the square peg that the adapter
        // actually wraps.
        return peg.getWidth() * Math.sqrt(2) / 2


// Somewhere in client code.
hole = new RoundHole(5)
rpeg = new RoundPeg(5)
hole.fits(rpeg) // true

small_sqpeg = new SquarePeg(5)
large_sqpeg = new SquarePeg(10)
hole.fits(small_sqpeg) // this won't compile (incompatible types)

small_sqpeg_adapter = new SquarePegAdapter(small_sqpeg)
large_sqpeg_adapter = new SquarePegAdapter(large_sqpeg)
hole.fits(small_sqpeg_adapter) // true
hole.fits(large_sqpeg_adapter) // false

```

## Uygulanabilirlik 

**Mevcut bazı sınıfları kullanmak istediğinizde Adapter sınıfını kullanın, ancak arabirimi kodunuzun geri kalanıyla uyumlu değil.**

Adapter modeli, kodunuz ile eski bir sınıf, 3. taraf bir sınıf veya garip bir arayüze sahip başka herhangi bir sınıf arasında çevirmen görevi gören bir orta katman sınıfı oluşturmanıza olanak tanır.

**Üst sınıfa eklenemeyen bazı ortak işlevlere sahip olmayan var olan birkaç alt sınıfı yeniden kullanmak istediğinizde kalıbı kullanın.**

Her bir alt sınıfı genişletebilir ve eksik işlevselliği yeni alt sınıflara koyabilirsiniz. Ancak, gerçekten kötü kokan tüm bu yeni sınıflarda kodu çoğaltmanız gerekecek.

Çok daha zarif çözüm, eksik işlevselliği bir bağdaştırıcı sınıfına koymak olacaktır. Ardından, eksik özelliklere sahip nesneleri adaptörün içine sararak gerekli özellikleri dinamik olarak kazanırsınız. Bunun çalışması için, hedef sınıfların ortak bir arabirime sahip olması ve adaptörün alanının bu arabirimi takip etmesi gerekir. Bu yaklaşım, Dekoratör modeline çok benziyor.

## Nasıl Uygulanır?

1. Uyumsuz arayüzlere sahip en az iki sınıfınız olduğundan emin olun: 
- Değiştiremeyeceğiniz kullanışlı bir hizmet sınıfı (genellikle 3. taraf, eski veya çok sayıda mevcut bağımlılık). 
- Hizmet sınıfını kullanmaktan fayda sağlayacak bir veya daha fazla müşteri sınıfı.

2. İstemci arabirimini bildirin ve istemcilerin hizmetle nasıl iletişim kurduğunu açıklayın.
3. Adaptör sınıfını oluşturun ve istemci arabirimini takip etmesini sağlayın. Şimdilik tüm yöntemleri boş bırakın.
4. Hizmet nesnesine bir başvuruyu depolamak için adaptör sınıfına bir alan ekleyin. Yaygın uygulama, bu alanı yapıcı aracılığıyla başlatmaktır, ancak bazen yöntemlerini çağırırken Adaptöre iletmek daha uygundur.
5. İstemci arabiriminin tüm yöntemlerini Adaptör sınıfında birer birer uygulayın. Adaptör, gerçek işin çoğunu hizmet nesnesine devrederek yalnızca arabirimi veya veri formatı dönüştürmesini gerçekleştirmelidir.
6. İstemciler, Adaptöru istemci arabirimi aracılığıyla kullanmalıdır. Bu, istemci kodunu etkilemeden Adaptörları değiştirmenize veya genişletmenize olanak tanır.

## Avantaj ve Dezavantajlar

### Avantajları

- Tek Sorumluluk İlkesi. Arayüzü veya veri dönüştürme kodunu programın birincil iş mantığından ayırabilirsiniz. 
- Açık/Kapalı İlkesi. İstemci arabirimi üzerinden bağdaştırıcılarla çalıştıkları sürece, mevcut istemci kodunu bozmadan yeni tür bağdaştırıcıları programa tanıtabilirsiniz.

### Dezavantajları

Bir dizi yeni arabirim ve sınıf tanıtmanız gerektiğinden, kodun genel karmaşıklığı artar. Bazen hizmet sınıfını kodunuzun geri kalanıyla eşleşecek şekilde değiştirmek daha kolaydır.

## Diğer Kalıplarla İlişkiler

Bridge is usually designed up-front, letting you develop parts of an application independently of each other. On the other hand, Adapter is commonly used with an existing app to make some otherwise-incompatible classes work together nicely.

Adapter changes the interface of an existing object, while Decorator enhances an object without changing its interface. In addition, Decorator supports recursive composition, which isn’t possible when you use Adapter.

Adapter provides a different interface to the wrapped object, Proxy provides it with the same interface, and Decorator provides it with an enhanced interface.

Facade defines a new interface for existing objects, whereas Adapter tries to make the existing interface usable. Adapter usually wraps just one object, while Facade works with an entire subsystem of objects.

Bridge, State, Strategy (and to some degree Adapter) have very similar structures. Indeed, all of these patterns are based on composition, which is delegating work to other objects. However, they all solve different problems. A pattern isn’t just a recipe for structuring your code in a specific way. It can also communicate to other developers the problem the pattern solves